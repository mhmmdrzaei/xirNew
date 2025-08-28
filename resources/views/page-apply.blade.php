<?php
/**
 * Template Name: Apply (Custom)
 */
?>

@extends('layouts.app')

@section('content')
  <div class="wrap page-apply">

    <h1 class="page-title">{!! get_the_title() !!}</h1>
    <h3>test</h3>
    <div class="page-content">@php the_content() @endphp</div>
  </div>
@endsection
