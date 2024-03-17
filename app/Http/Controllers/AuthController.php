<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repository\Employee\EmployeeRepositoryInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function loginPage(): Factory|View|Application
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $user = $this->employeeRepository->getByPhoneOrEmail($request->get('credential'));
        if ($user) {
            if (Hash::check($request->get('password'), $user->password)) {
                auth()->login($user);
                return redirect()->route('home');
            }
        }

        return back()->withErrors(['password' => 'the credential is incorrect'])
            ->withInput($request->only('credential', 'remember'));
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
