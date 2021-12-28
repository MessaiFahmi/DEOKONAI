@extends('errors::layout')

@section('title', $error['title'])
@section('code', $error['code'])
@section('message', $error['message'])
