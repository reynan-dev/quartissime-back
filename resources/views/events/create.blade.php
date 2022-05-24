@extends('layouts.dashboard.details')

@section('title', 'Créer un nouveau événement')

@section('details')

    <form action="" method="post">
        @csrf

        <input type="hidden" name="committee_id" value="">

        <div class="input-row">
            <div class="label">
                <label for="title">Title*</label>
            </div>
            <div class="input-form">
                <input type="text" name="title" required>
            </div>
        </div>

        <div class="input-row">
            <div class="label">
                <label for="date">Date*</label>
            </div>
            <div class="input-form">
                <input type="datetime" name="date" required>
            </div>
        </div>

        <div class="input-row">
            <div class="label">
                <label for="adresse">Adresse*</label>
            </div>
            <div class="input-form">
                <input type="text" name="adresse" required>
            </div>
        </div>

        <div class="input-row">
            <div class="label">
                <label for="date">Link du évévenemnt</label>
            </div>
            <div class="input-form">
                <input type="text" name="date">
            </div>
        </div>

        <div class="input-row">
            <div class="label">
                <label for="date">Date</label>
            </div>
            <div class="input-form">
                <input type="text" name="date">
            </div>
        </div>

        <div class="input-row">
            <div class="label">
                <label for="date">Date</label>
            </div>
            <div class="input-form">
                <input type="text" name="date">
            </div>
        </div>

    </form>

@endsection