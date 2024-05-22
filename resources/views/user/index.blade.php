@extends('layout.stage')

<div>
    <div class="navbar-icon">
        <img src="{{ asset('images/Logo-Polinema.png') }}" alt="logo" class="logo">
    </div>
    <div class="navbar-btn">
        <a href="/home" class="btn-nav">Dashboard</a>
        <a href="/list-book" class="btn-nav">Book List</a>
        <a href="/viewCart" class="btn-nav">Cart</a>
        <a href="/viewBorrow" class="btn-nav">Return Book</a>
        <a href="/bukus" class="btn-nav">Add Book</a>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn-out">Logout</button>
        </form>
    </div>
</div>

<div class="dashboard">
    <div class="container-dashboard-home">
        <label class="label" for="dashboard">Welcome to Dashboard</label>
    </div>
</div>

