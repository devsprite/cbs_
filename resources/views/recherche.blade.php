<h2>Opérateurs CBS  - {{ count($recherches['operateurs']) }}</h2>
@foreach($recherches['operateurs'] as $ro)
<p class="">{{ date('d/m/Y : H:i:s', strtotime($ro->heure_de_debut)) }} : {{ date('H\h i\m', strtotime($ro->duree)) }} : <strong>{{ $ro->cause }}
        {{ !empty($ro->mobile) ? ' : ' . $ro->mobile .' : '. $ro->numero_canton : '' }}
    </strong> : {{ $ro->commentaires }}</p>
@endforeach

<h2>Logs automate  - {{ count($recherches['automate']) }}</h2>
@foreach($recherches['automate'] as $ra)
<p class="">{{ date('d/m/Y', strtotime($ra->date)) }} : {{ $ra->time }} : {{ $ra->etat_2 }} <strong>{{ $ra->defaut }}</strong> : {{ $ra->description }} </p>
@endforeach