<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('halaman keamanan akun can be rendered', function () {
    $response = $this->get(route('keamanan.index'));

    $response->assertSuccessful();
    $response->assertSee('Ubah Kata Sandi');
});

test('user can change password successfully', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password_lama123'),
    ]);

    $response = $this->actingAs($user)->put(route('keamanan.update'), [
        'current_password' => 'password_lama123',
        'password' => 'password_baru123',
        'password_confirmation' => 'password_baru123',
    ]);

    $response->assertSessionHas('success', 'Kata sandi berhasil diperbarui!');
    expect(Hash::check('password_baru123', $user->fresh()->password))->toBeTrue();
});

test('password change fails if current password is wrong', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password_lama123'),
    ]);

    $response = $this->actingAs($user)->put(route('keamanan.update'), [
        'current_password' => 'salah_password',
        'password' => 'password_baru123',
        'password_confirmation' => 'password_baru123',
    ]);

    $response->assertSessionHasErrors('current_password');
    expect(Hash::check('password_lama123', $user->fresh()->password))->toBeTrue();
});

test('password change fails if confirmation does not match', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password_lama123'),
    ]);

    $response = $this->actingAs($user)->put(route('keamanan.update'), [
        'current_password' => 'password_lama123',
        'password' => 'password_baru123',
        'password_confirmation' => 'tidak_cocok123',
    ]);

    $response->assertSessionHasErrors('password');
});

test('password change fails if new password is too short', function () {
    $user = User::factory()->create([
        'password' => Hash::make('password_lama123'),
    ]);

    $response = $this->actingAs($user)->put(route('keamanan.update'), [
        'current_password' => 'password_lama123',
        'password' => 'pendek',
        'password_confirmation' => 'pendek',
    ]);

    $response->assertSessionHasErrors('password');
});
