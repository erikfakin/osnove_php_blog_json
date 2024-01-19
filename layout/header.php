<?php

function getHeader()
{
    $currentPath = $_SERVER["REQUEST_URI"];

    echo "<header>
        <div class='header__links'>
            <a class='header__logo'href='/'>JSON Blog</a>
            <a " . ($currentPath == "/" ? "class='active'" : "") . " href='/'>Početna</a>
            <a " . ($currentPath == "/posts/" ? "class='active'" : "") . " href='/posts/'>Svi postovi</a>
            <a " . ($currentPath == "/create_post/" ? "class='active'" : "") . " href='/create_post/'>Dodaj novi post</a>
        </div>
        <div class='header__search'>
            <form action='/posts'>
                <input name='search' type='text' placeholder='Pretraži...'/>
                <button>
                    <span class='header__search__image'></span>
                </button>
            </form>
        </div>
    </header>";
}
