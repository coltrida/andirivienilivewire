<div>
    <div class="grid gap-6 mb-6 md:grid-cols-7">
        <div>
            <select wire:model="activity_id" wire:change="attivitaSelezionata" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected value="">Attività</option>
                @foreach($listaAttivita as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <div x-data="{ open: false }">
            <!-- Finestra fissa -->
            <div x-show="open" x-transition class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
                <div class="bg-black rounded-lg w-96 h-72 overflow-hidden shadow-lg">
                    <!-- Header della finestra -->
                    <div class="flex justify-between items-center p-4 border-b">
                        <h2 class="text-lg font-semibold">Lista Clienti</h2>
                        <button @click="open = false" class="text-red-500">Chiudi</button>
                    </div>

                    <!-- Lista con scorrimento -->
                    <div class="p-4 overflow-y-auto h-56">
                        <ul>
                            @foreach($listaRagazzi as $client)
                                <div class="flex items-center mb-4">
                                    <input wire:model="clients" id="default-checkbox-{{$client->id}}" type="checkbox" value="{{$client->id}}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox-{{$client->id}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$client->name}}</label>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <button @click="open = true" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Sel. Clienti
            </button>
        </div>

        <div>
            <input wire:model="giorno" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  />
        </div>

        <div>
            <input wire:model="quantita" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="q.tà" />
        </div>
        <div>
            <input wire:model="note" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="note" />
        </div>

        <div>
            <button wire:click="inserisci" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Inserisci
            </button>
        </div>
    </div>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-4">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
            <tr class="text-center">
                <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    Ragazzo
                </th>
                <th scope="col" class="px-6 py-3">
                    Giorno
                </th>
                <th scope="col" class="px-6 py-3">
                    Attività
                </th>
                <th scope="col" class="px-6 py-3">
                    Quantità
                </th>
                <th scope="col" class="px-2 py-3">
                    Azioni
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($listaAttivitaClientPaginate as $item)
                <tr class="bg-white text-center dark:text-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->id}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->client->name}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->giorno}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->activity->name}}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->quantita}}
                    </th>
                    <td class="px-6 py-4 flex justify-center">
                        <button
                            wire:click="elimina({{$item->id}})"
                            wire:confirm="Sei sicuro che vuoi eliminare {{$item->id}}?"
                            title="elimina" class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-pink-500 to-orange-400 group-hover:from-pink-500 group-hover:to-orange-400 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800">
                    <span class="relative px-3 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                          <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                        </svg>
                    </span>
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $listaAttivitaClientPaginate->links(data: ['scrollTo' => false]) }}
    </div>

        <script>
            window.addEventListener('info', event => {
                Swal.fire({
                    icon: 'success',
                    title: event.detail[0].title,
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        </script>

</div>



