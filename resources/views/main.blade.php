@extends('listado')
@section('content')
    <!--start here Data-->
    <!-- <principal></principal>-->


   
    <reception v-if="indice==0"></reception>
    <type-room v-if="indice==1"></type-room>
    <room v-if="indice==2"></room>
    <ticket v-if="indice==3"></ticket>
    <checkbook v-if="indice==4"></checkbook>
    <buy v-if="indice==5"></buy>
    <links v-if="indice==8"></links>
    <worker v-if="indice==9"></worker>
    <user v-if="indice==12"></user>
    <certificate v-if="indice==16"></certificate>
    <client v-if="indice==17"></client>
    <category v-if="indice==20"></category>
    <product v-if="indice==21"></product>
    <additional v-if="indice==24"></additional>
    <provider v-if="indice==22"></provider>
    <companion v-if="indice==23"></companion>


        <!--Inicio del modal agregar/actualizar-->
    
    <!-- Fin del modal Eliminar -->
@endsection