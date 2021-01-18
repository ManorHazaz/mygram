<nav class="side-nav">
    <ul>
        <li>
            <a href="{{ route('profile.edit' , $user) }}" class="link-clean @if(request()->is('profile*')) active @endif">Edit profile</a>
        </li>            
        <li>
            <a href="{{ route('user.edit' , $user) }}" class="link-clean @if(request()->is('user*')) active @endif">Edit User</a>
        </li>                       
    </ul>
</nav>