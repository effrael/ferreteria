<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Páginas públicas del sitio: Home y páginas informativas.
 * No llevan middleware: deben verse con o sin sesión iniciada.
 */
class PaginaController extends Controller
{
    public function home(): View
    {
        return view('site.home');
    }

    public function nosotros(): View
    {
        return view('site.nosotros');
    }

    public function precios(): View
    {
        return view('site.precios');
    }

    public function faqs(): View
    {
        return view('site.faqs');
    }

    public function contacto(): View
    {
        return view('site.contacto');
    }

    /**
     * Guarda un mensaje del formulario público de Contacto.
     */
    public function enviarContacto(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:100'],
            'ferreteria' => ['nullable', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:20'],
            'tipo' => ['required', 'in:demo,precios,soporte,otro'],
            'mensaje' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'nombre.required' => 'Necesitamos tu nombre para responderte.',
            'email.required' => 'Déjanos un correo para poder contestarte.',
            'email.email' => 'Ese correo no parece válido, revísalo.',
            'tipo.required' => 'Cuéntanos sobre qué es tu consulta.',
            'tipo.in' => 'Elige uno de los tipos de consulta de la lista.',
            'mensaje.required' => 'Escríbenos tu consulta.',
            'mensaje.min' => 'Cuéntanos un poco más, con al menos 10 caracteres.',
        ]);

        Contacto::create($datos);

        return redirect()
            ->route('contacto')
            ->with('status', '¡Gracias! Recibimos tu mensaje y te respondemos en menos de un día hábil.');
    }
}
