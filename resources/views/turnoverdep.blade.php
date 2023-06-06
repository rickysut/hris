@extends('layouts.app')
@section('content')
<x-moonshine::title
@class('text-center')>Turn-over report</x-moonshine::title>
{{ $report->render() }}
@endsection
