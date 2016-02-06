{% extends 'templates/default.php' %}


{% block title %}Register{% endblock %}

{% block content %}
    <form action="{{ urlFor('register.post') }}" method="post" autocomplete="off">
        <div>
            <label for="email">Email</label>
            <input id="email" type="text" name="email" placeholder="Your E-mail">
        </div>
        <div>
            <label for="username">Username</label>
            <input id="username" type="text" name="username" placeholder="Type in a Username">
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Password">
        </div>
        <div>
            <label for="password_confirm">Confirm Password</label>
            <input id="password_confirm" type="password" name="password_confirm" placeholder="Enter your password again">
        </div>
        <div>
            <input type="submit" value="Register">
        </div>
    </form>
{% endblock %}
