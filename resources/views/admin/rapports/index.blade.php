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
                        Rapports sur tables auteurs
                    </div>
                    <div class="p-2">
                        <ul class="list-disc pl-4">
                            <li><x-adm-link lien='rapports/dates-bizarres'>Dates de naissance bizarres</x-adm-link></li>
                            <li><x-adm-link lien='rapports/manque-date-naissance'>Date de naissance inconnue</x-adm-link> (mais décès connu)</li>
                            <li><x-adm-link lien='rapports/manque-date-deces'>Date de décès inconnue</x-adm-link> (et naissance connue)</li>
                            <li><x-adm-link lien='rapports/manque-nationalite'>Nationalité manquante</x-adm-link></li>
                            <li>Bios <x-adm-link lien='rapports/etat-biographies-0'>"vides"</x-adm-link> et
                            <x-adm-link lien='rapports/etat-biographies-1'>"en ébauche"</x-adm-link></li>
                            <li>Et bios en état <x-adm-link lien='rapports/etat-biographies-2'>"moyen"</x-adm-link>, 
                            <x-adm-link lien='rapports/etat-biographies-3'>"acceptable"</x-adm-link> ou 
                            <x-adm-link lien='rapports/etat-biographies-5'>"validées"</x-adm-link></li>
                            <li>Bios <x-adm-link lien='rapports/etat-biographies-4'>"à valider"</x-adm-link> et
                            <x-adm-link lien='rapports/etat-biographies-9'>"à revoir"</x-adm-link></li>
                            <li>(Fiches manquantes en base : non encore porté - pas forcément utile puisque plus besoin à terme)</li>
                        </ul>
                    </div>
                    <div class="p-2 text-2xl border-b border-yellow-800">
                        Rapports sur tables prix
                    </div>
                    <div class="p-2">
                        <ul class="list-disc pl-4">
                            <li><x-adm-link lien='rapports/prix-{{ date("Y") - 3 }}'>Manquants avant {{ date("Y") - 3 }} (ou prix arrété non indiqué)</x-adm-link></li>
                            <li><x-adm-link lien='rapports/prix-{{ date("Y") - 2 }}'>Manquants en {{ date("Y") - 2 }} ou avant</x-adm-link></li>
                            <li><x-adm-link lien='rapports/prix-{{ date("Y") - 1 }}'>Manquants en {{ date("Y") - 1 }} ou avant</x-adm-link></li>                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
