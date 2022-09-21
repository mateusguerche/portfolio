<h4>Login</h4>
<h6>Preencha os campos para entrar no sistema</h6>

<form action="{{ route('auth.login') }}" method="POST">
    @csrf
    @method('POST')
    <div>
        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required>
    </div>
    <div class="mb-3">
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" placeholder="Senha" required>
    </div>
    <div>
        <button type="submit">Entrar</button>
    </div>
</form>
