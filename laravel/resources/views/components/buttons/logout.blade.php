<div>
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button class="bg:red" type="submit">logout</button>
    </form>
</div>