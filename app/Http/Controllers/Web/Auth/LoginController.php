<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Exception;
use App\Exceptions\CustomException;
use App\Http\Requests\Web\Auth\LoginRequest;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Formulário de login <administrador, médico, gestor e paciente>.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function formLogin()
    {
        return view('auth.login');
    }

    /**
     * Login <administrador, médico, gestor e paciente>.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        DB::beginTransaction();

        try {
            $credentials = $request->only('email', 'password');

            if (!Auth::validate($credentials)) {
                throw new CustomException('E-mail/senha incorretos.');
            }

            $user = User::where('email', $credentials['email'])->first();

            if (!$user->status) {
                throw new CustomException('Sua conta está suspensa.');
            }

            Auth::guard('web')->attempt($credentials, $request->remember);
            $request->session()->regenerate();
        } catch (CustomException $e) {
            DB::rollback();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->with(['error' => 'Não foi possível logar.']);
        }

        DB::commit();
        return redirect()->route('dashboard.index');
    }
}
