@extends('layouts.base')

@section('content')
    <p style="color:white">{{ var_dump(sys_getloadavg()[0]) }}</p>
    <p style="color:white">{{ var_dump((int)shell_exec("cat /proc/cpuinfo | grep processor | wc -l")) }}</p>
@endsection