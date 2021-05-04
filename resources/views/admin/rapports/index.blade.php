<x-app-layout>
    <!-- Page d'accueil administration (jetstream) -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Administration BDFI &rarr; Rapports') !!}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6">
                    <div class="p-2 text-2xl border-b border-yellow-800">
                        Rapports sur table auteurs
                    </div>
                    <div class="p-2">
                        <ul class="list-disc pl-4">
                            <li><x-adm-link lien='rapports/dates-bizarres'>Dates de naissance bizarres</x-adm-link></li>
                            <li><x-adm-link lien='rapports/manque-date-naissance'>Date de naissance inconnue</x-adm-link> (mais décès connu)</li>
                            <li><x-adm-link lien='rapports/manque-date-deces'>Date de décès inconnue</x-adm-link> (et naissance connue)</li>
                            <li><x-adm-link lien='rapports/manque-nationalite'>Nationalité manquante</x-adm-link></li>
                            <li><x-adm-link lien='rapports/etat-biographies-0'>Bios "vides"</x-adm-link></li>
                            <li><x-adm-link lien='rapports/etat-biographies-1'>Bios en "ébauche"</x-adm-link></li>
                            <li><x-adm-link lien='rapports/etat-biographies-2'>Bios en état moyen</x-adm-link></li>
                            <li><x-adm-link lien='rapports/etat-biographies-3'>Bios en état acceptable</x-adm-link></li>
                            <li><x-adm-link lien='rapports/etat-biographies-4'>Bios terminées : A valider</x-adm-link></li>
                            <li><x-adm-link lien='rapports/etat-biographies-5'>Bios validées</x-adm-link></li>
                            <li><x-adm-link lien='rapports/etat-biographies-9'>Bios à revoir</x-adm-link></li>
                            <li>(Fiches manquantes en base : non encore porté - pas forcément utile puisque plus besoin à terme)</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
