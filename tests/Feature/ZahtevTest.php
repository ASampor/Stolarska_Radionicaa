<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Zahtev;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZahtevTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function klijent_moze_uspesno_da_kreira_zahtev()
    {
        // 1. Kreiramo klijenta (email bez @wooddesign)
        /** @var \App\Models\User $klijentUser */
        $klijentUser = User::factory()->create([
            'email' => 'klijent@example.com'
        ]);

        // 2. Autentifikujemo ga i šaljemo POST zahtev sa klijent_id
        $response = $this->actingAs($klijentUser)->post(route('klijent.zahtev.store'), [
            'Klijent_id' => $klijentUser->id, // OBAVEZNO
            'Vrsta_proizvoda' => 'Sto',
            'Opis' => 'Drveni sto od hrasta',
            'Lokacija' => 'Beograd',
            'Telefon' => '061234567',
        ]);

        // 3. Proveravamo redirect (dashboard)
        $response->assertRedirect(route('klijent.dashboard'));

        // 4. Proveravamo da je zapis u bazi
        $this->assertDatabaseHas('zahtevi', [
            'Klijent_id' => $klijentUser->id,
            'Vrsta_proizvoda' => 'Sto',
            'Opis' => 'Drveni sto od hrasta',
            'Lokacija' => 'Beograd',
            'Telefon' => '061234567',
        ]);
    }

    /** @test */
    public function zahtev_ne_moze_da_se_kreira_bez_obaveznih_polja()
    {
        // 1. Kreiramo klijenta
        /** @var \App\Models\User $klijentUser */
        $klijentUser = User::factory()->create([
            'email' => 'klijent@example.com'
        ]);

        // 2. Pokušavamo da kreiramo zahtev sa praznim poljima
        $response = $this->actingAs($klijentUser)->post(route('klijent.zahtev.store'), [
            'Vrsta_proizvoda' => '',
            'Opis' => '',
            'Lokacija' => '',
            'Telefon' => '',
        ]);

        // 3. Validator bi trebao da prijavi greške
        $response->assertSessionHasErrors(['Vrsta_proizvoda', 'Lokacija', 'Telefon']);

        // 4. Baza ostaje prazna
        $this->assertDatabaseCount('zahtevi', 0);
    }
}
