<!doctype html >
<html dir="rtl" lang="en">
@extends('layouts.head')
<body>
@include('layouts.navbar')
@yield('contact')
<hr>
@extends('layouts.footer')
<script src="{{asset('assets/Js/custom-Js.js')}}"></script>
@livewireScripts
</body>
</html>
