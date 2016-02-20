{% extends 'templates/default.php' %}

{% block title %}Change Password{% endblock %}

{% block content %}
    <h2>Change Password</h2>
    <form action="{{ urlFor('password.change.post') }}" method="POST" autocomplete="off">
        <div>
            <label for="password_old">Old Password</label>
            <input type="password" name="password_old" id="password_old">
            {% if errors.has('password_old') %} {{ errors.first('password_old') }} {% endif %}
        </div>
        <div>
            <label for="password">New Password</label>
            <input type="password" name="password" id="password">
            {% if errors.has('password') %} {{ errors.first('password') }} {% endif %}
        </div>
        <div>
            <label for="password_confirm">Confim Password</label>
            <input type="password" name="password_confirm" id="password_confirm">
            {% if errors.has('password_confirm') %} {{ errors.first('password_confirm') }} {% endif %}
        </div>
        <div>
            <input type="submit"  value="Change Password">
        </div>
        <input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">
    </form>
{% endblock %}
