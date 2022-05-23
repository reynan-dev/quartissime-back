@extends('layouts.dashboard.committee')

@section('newAssociations')
    @foreach ($newAssociations as $item)
        <li class="list">
            <div class="title">{{ $item->name }}</div>
            <div class="tools">
                <button class="accept"><i class="fa-solid fa-check"></i> Accepté</button>
                <button class="refuse"><i class="fa-solid fa-xmark"></i> Refuse</button>
            </div>
        </li>
    @endforeach
@endsection

@section('associations')
    @foreach ($associations as $item)
        <li class="list">
            <div class="title">{{ $item->name }}</div>
            <div class="tools">
                <button class="edit"><i class="fa-solid fa-pen"></i></button>
                <button class="refuse"><i class="fa-solid fa-trash-can"></i></button>
            </div>
        </li>
    @endforeach
@endsection

@section('events')
    @foreach ($events as $item)
        <li class="list">
            <div class="title">{{ $item->name }}</div>
            <div class="tools">
                <button class="edit"><i class="fa-solid fa-pen"></i></button>
                <button class="refuse"><i class="fa-solid fa-trash-can"></i></button>
            </div>
        </li>
    @endforeach
@endsection
