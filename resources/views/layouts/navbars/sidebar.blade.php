@php
    $book = in_array($pageSlug, ['book_control', 'create_book', 'edit_book']) ? 'true' : 'false';
    $loan = in_array($pageSlug, ['loan_config', 'loan_control', 'make_loan']) ? 'true' : 'false';
    $member = in_array($pageSlug, ['member_control', 'create_member', 'edit_member']) ? 'true' : 'false';
    $user = in_array($pageSlug, ['user_control', 'create_user', 'edit_user']) ? 'true' : 'false';
@endphp

<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">MP</a>
            <a href="#" class="simple-text logo-normal">Menu Principal</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#loan" aria-expanded="{{ $loan }}">
                    <i class="fa-solid fa-list-check"></i>
                    <span class="nav-link-text">Empréstimos</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="{{ $loan == 'true' ? 'collapse show' : 'collapse' }}" id="loan">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'loan_control') class="active" @endif>
                            <a href="{{ route('loan.index') }}">
                                <i class="fa-solid fa-book-open-reader"></i>
                                <p>Controle</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'make_loan') class="active" @endif>
                            <a href="{{ route('loan.create') }}">
                                <i class="fa-regular fa-handshake"></i>
                                <p>Realizar Empréstimo</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'loan_config') class="active" @endif>
                            <a href="{{ route('loan_term.create') }}">
                                <i class="fa-solid fa-gear"></i>
                                <p>Configurações</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($book == 'true') class="active" @endif>
                <a href="{{ route('book.index') }}">
                    <i class="fas fa-book"></i>
                    <p>Livros</p>
                </a>
            </li>
            <li @if ($member == 'true') class="active" @endif>
                <a href="{{ route('member.index') }}">
                    <i class="fas fa-users"></i>
                    <p>Membros</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#users" aria-expanded="{{ $user }}">
                    <i class="fa-solid fa-circle-user"></i>
                    <span class="nav-link-text">Usuário</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="{{ $user == 'true' ? 'collapse show' : 'collapse' }}" id="users">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'user_control' || $pageSlug == 'create_user') class="active" @endif>
                            <a href="{{ route('user.index') }}">
                                <i class="fa-solid fa-clipboard-user"></i>
                                <p>Controle de Usuários</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'edit_user') class="active" @endif>
                            <a href="{{ route('user.edit', ['user' => serialize(auth()->user()->id)]) }}">
                                <i class="fa-solid fa-user-pen"></i>
                                <p>Perfil</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Sair</p>
                </a>
            </li>
        </ul>
    </div>
</div>
