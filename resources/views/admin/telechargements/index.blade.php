<x-app-layout>
    <!-- Page d'accueil administration (jetstream) -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {!! __('Administration BDFI &rarr; Téléchargements') !!}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6">
                    <div class="border border-yellow-800 bg-yellow-100 rounded-lg p-2">
                        <p>Les liens suivants permettent de récupérer et télécharger le backup complet d'une table de la base. Les fichiers sont tous au format CSV. Attention, la table des biographies peut être un peu plus lente que les autres.</p>
                        <p>Peut être utilisé sans riques... Bien au contraire, faire des sauvegardes régulières peut nous être utile un jour.</p>
                    </div>

                    <div class="p-6">
                        <div class="p-2 text-2xl border-b border-yellow-800">
                            Tables autours des auteurs
                        </div>
                        <div class="p-2">
                            <ul class="list-disc pl-4">
                                <li><x-adm-link lien='/admin/telechargements/Author'>auteurs</x-adm-link></li>
                                <li><x-adm-link lien='/admin/telechargements/Signature'>signatures</x-adm-link></li>
                                <li><x-adm-link lien='/admin/telechargements/Website'>sites web</x-adm-link></li>
                                <li><x-adm-link lien='/admin/telechargements/Relationship'>relations entre auteurs</x-adm-link></li>
                                <li><x-adm-link lien='/admin/telechargements/Country'>pays</x-adm-link></li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="p-2 text-2xl border-b border-yellow-800">
                            Evènements et annonces
                        </div>
                        <div class="p-2">
                            <ul class="list-disc pl-4">
                                <li><x-adm-link lien='/admin/telechargements/Event'>salons et évènements</x-adm-link></li>
                                <li><x-adm-link lien='/admin/telechargements/Announcement'>news et annonces sites</x-adm-link></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
