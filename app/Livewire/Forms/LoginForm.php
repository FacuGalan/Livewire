<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $user = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
  public function authenticate(): void
{
    $this->ensureIsNotRateLimited();

    // Primero, buscar al usuario por email y usuario
    $user = \App\Models\User::where('email', $this->email)
                           ->where('user', $this->user)
                           ->first();

    // Si no se encuentra el usuario o la contraseña no coincide
    if (!$user || !\Illuminate\Support\Facades\Hash::check($this->password, $user->password)) {
        RateLimiter::hit($this->throttleKey());

        // Determinamos qué campos tienen error
        $errors = [];
        
        if (!$user) {
            // Si no encontramos al usuario, pueden ser el email o el nombre de usuario
            $emailExists = \App\Models\User::where('email', $this->email)->exists();
            $userExists = \App\Models\User::where('user', $this->user)->exists();
            
            if (!$emailExists) {
                $errors['form.email'] = trans('El correo electrónico no está registrado');
            }
            
            if (!$userExists) {
                $errors['form.user'] = trans('El nombre de usuario no está registrado');
            }
            
            // Si ambos existen pero no juntos
            if ($emailExists && $userExists) {
                $errors['form.email'] = trans('El correo y usuario no coinciden con ninguna cuenta');
            }
        } else {
            // El usuario existe pero la contraseña es incorrecta
            $errors['form.password'] = trans('La contraseña es incorrecta');
        }
        
        // Si no se determinó ningún error específico, mostrar un mensaje genérico
        if (empty($errors)) {
            $errors['form.email'] = trans('Las credenciales proporcionadas no son correctas');
        }
        
        throw ValidationException::withMessages($errors);
    }

    // Si llegamos aquí, las credenciales son correctas
    Auth::login($user, $this->remember);
    RateLimiter::clear($this->throttleKey());

    // Regenerar la sesión para evitar ataques de session fixation
    Session::regenerate();
}
    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}