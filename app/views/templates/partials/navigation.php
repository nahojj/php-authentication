{% if auth %}
    <p>Hello, {{ auth.getFullNameOrUsername }}!</p>
    <img src="{{ auth.getAvatarUrl({size: 30}) }}" alt="Your avatar" />
{% endif %}

<ul>
    <li><a href="{{ urlFor('home') }}">Home</a></li>
    {% if auth %}
        <li><a href="{{ urlFor('user.profile', {username: auth.username}) }}">Your profile</a></li>
        <li><a href="{{ urlFor('logout') }}">Log Out</a></li>
        {% if auth.isAdmin %}
            <li><a href="{{ urlFor('admin.example') }}">Admin</a></li>
        {% endif %}
    {% else %}
        <li><a href="{{ urlFor('login') }}">Login</a></li>
        <li><a href="{{ urlFor('register') }}">Register</a></li>
    {% endif %}
        <li><a href="{{ urlFor('user.all') }}">All users</a></li>
</ul>
