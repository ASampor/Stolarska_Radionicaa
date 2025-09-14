<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Stolar;
use App\Models\Klijent;
use App\Models\Zahtev;
use App\Models\Sastanak;

class SastanakTest extends TestCase
{
    use RefreshDatabase;

    protected $stolarUser;
    protected $stolar;
    protected $klijent;
    protected $zahtev;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Kreiramo korisnika koji je stolar
        $this->stolarUser = User::factory()->create([
            'email' => 'stolar@wooddesign',
            'role' => 'stolar'
        ]);

        // 2. Kreiramo Stolar model sa svim obaveznim poljima
        $this->stolar = Stolar::create([
            'Ime' => 'Petar',
            'Prezime' => 'Petrović',
            'Email' => $this->stolarUser->email,
            'Lozinka' => bcrypt('tajna'), 
            'Telefon' => '061234567',     
        ]);

        // 3. Kreiramo klijenta
        $this->klijent = Klijent::create([
            'Ime' => 'Marta',
            'Prezime' => 'Marček',
            'Email' => 'mmm@gmail.com',
            'Lozinka' => bcrypt('tajna'),
        ]);

        // 4. Kreiramo zahtev povezan sa klijentom
        $this->zahtev = Zahtev::create([
            'Vrsta_proizvoda' => 'Sto',
            'Opis' => 'Drveni sto od hrasta',
            'Lokacija' => 'Beograd',
            'Telefon' => '061234567',
            'Klijent_id' => $this->klijent->ID_Klijent,
        ]);
    }

    /** @test */
    public function stolar_moze_da_kreira_sastanak()
    {
        $datumVreme = now()->addDay()->format('Y-m-d H:i:s');

        $response = $this->actingAs($this->stolarUser)->post(route('stolar.sastanci.store'), [
            'Zahtev_id' => $this->zahtev->id,
            'Datum_vreme' => $datumVreme,
        ]);

        $response->assertRedirect(route('stolar.sastanci'));

        $this->assertDatabaseHas('sastanak', [
            'Zahtev_id' => $this->zahtev->id,
            'Stolar_id' => $this->stolar->ID_Stolar,
            'Datum_vreme' => $datumVreme,
        ]);
    }

    /** @test */
    public function sastanak_ne_moze_da_se_kreira_bez_obaveznih_polja()
    {
        $response = $this->actingAs($this->stolarUser)->post(route('stolar.sastanci.store'), [
            'Zahtev_id' => '',
            'Datum_vreme' => ''
        ]);

        $response->assertSessionHasErrors(['Zahtev_id', 'Datum_vreme']);

        $this->assertDatabaseCount('sastanak', 0);
    }
}
