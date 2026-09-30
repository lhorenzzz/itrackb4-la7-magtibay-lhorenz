<nav>
    <br>
    {{-- Books --}}
    <button type="button" class="btn {{ request()->is('books*') ? 'btn-warning' : 'btn-primary' }}">
        <a href="{{ route('books.index') }}" style="color: white; text-decoration: none;">Books</a>
    </button>

    {{-- Teachers --}}
    <button type="button" class="btn {{ request()->is('teachers*') ? 'btn-warning' : 'btn-primary' }}">
        <a href="{{ route('teachers.index') }}" style="color: white; text-decoration: none;">Teachers</a>
    </button>

    {{-- Games --}}
    <button type="button" class="btn {{ request()->is('games*') ? 'btn-warning' : 'btn-primary' }}">
        <a href="{{ route('games.index') }}" style="color: white; text-decoration: none;">Games</a>
    </button>

</nav>
