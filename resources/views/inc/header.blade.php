<header style="display: flex; justify-content: space-between">
    <ul>
        <li><a href="/">Books</a></li>
        <li><a href="/authors">Authors</a></li>
    </ul>

    <form action="{{route('logout')}}">
        <button class="logout">
            Logout
        </button>
    </form>
</header>
