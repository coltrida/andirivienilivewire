<div>
    @if (session('status'))
        <div class="alert alert-success">
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    {{ session('status') }}
                </div>
            </div>

        </div>
    @endif

        <div class="grid gap-6 mb-6 md:grid-cols-4">
            <div>
                <select wire:model="client_id" wire:change="operatoreSelezionato()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Ragazzi</option>
                    @foreach($listaRagazzi as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-2">
                <button wire:click="inserisci" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Inserisci
                </button>

                <button wire:click="visualizza" class="focus:outline-none text-white bg-yellow-600 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                    Visualizza o elimina presenze
                </button>

                <button wire:click="stampa" class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                    Stampa
                </button>
            </div>

        </div>

    <div wire:ignore id='calendar'></div>

        @if($visualizzaPresenze)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mb-4">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
                    <tr class="text-center">
                        <th scope="col" class="px-6 py-3">
                            id
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Data
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stato
                        </th>
                        <th scope="col" class="px-2 py-3">
                            Azioni
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listaPresenze as $item)
                        <tr class="bg-white text-center dark:text-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item->id}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item->giorno}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$item->tipo}}
                            </th>

                            <td class="px-6 py-4 flex justify-center">
                                <button
                                    wire:click="elimina({{$item->id}})"
                                    wire:confirm="Sei sicuro che vuoi eliminare id: {{$item->id}}?"
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
            </div>
        @endif

    <style>
        .fc-toolbar {
            background-color: #bbb7b7; /* Cambia il colore con quello desiderato */
            color: #333; /* Cambia il colore del testo se necessario */
            padding: 5px;
            border-radius: 5px;
        }
        .fc {
            background-color: #0a1921; /* Cambia con il colore desiderato */
            border-radius: 5px;
        }
        .fc-day-sat, .fc-day-sun {
            background-color: #112b3a; /* Cambia con il colore desiderato */
        }
        .fc-daygrid-day-events{
            display: none;
        }
        .fc-daygrid-day {
            height: 50px; /* Imposta l'altezza desiderata */
        }
        input[type="radio"] {
            display: none;
        }

        label {
            position: relative;
            color: red;
            font-size: 20px;
            border: 2px solid red;
            border-radius: 5px;
            padding: 0 5px;
            width: 40px;
            box-shadow: 2px 2px 4px #000000;
        }


        input[type="radio"]:checked + label {
            background-color: #2d995b;
        }
    </style>
</div>

@assets
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
@endassets

@script
<script>

    document.addEventListener('livewire:initialized', function() {
        let component = @this;   // questo rappresenta il componente
        // console.log(component.visualizzaModale)
        /*console.log(component.prova);
        component.prova = 'modifica prova';   // equivalente a wire:model
        console.log(component.prova);
        component.set('prova', 'modifica live');  // equivalente a wire:model.live
        console.log(component.prova);
        component.azioneProva('Davide').then(function (res){
            console.log('azione effettuata')
        });*/

        let presenzeClientSelezionato = @json($presenzeClientSelezionato);
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            height: 520,
            locale: 'it',
            firstDay: 1,
            initialView: 'dayGridMonth',
            datesSet: function () {
                const currentDate = calendar.getDate(); // Ottieni la data corrente del calendario
                component.mese = currentDate.getMonth() + 1; // Mesi da 0 a 11, quindi aggiungi 1
                component.anno = currentDate.getFullYear();
                component.set('visualizzaPresenze', false);
            },

            dayCellContent: function (arg) {
                // Personalizza il contenuto della cella
                /*console.log(presenzeClientSelezionato)
                console.log(arg.date.getDate())*/
                let isPresent = presenzeClientSelezionato.includes(arg.date.getDate());
                return {
                    html: `<div style="display: flex!important; justify-content: space-between!important;">
                                <div style="margin: 0 20px; color: white">${arg.date.getDate()}</div>

                                    <input wire:model="valoriSelezionati${arg.date.getDate()}" value="P" id="one${arg.date.getDate()}" type="radio"/>
                                    <label for="one${arg.date.getDate()}" class="presenza relative px-5 py-1 m-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md dark:hover:bg-green-500">P</label>
                                    <input wire:model="valoriSelezionati${arg.date.getDate()}" value="A" id="two${arg.date.getDate()}" type="radio"/>
                                    <label for="two${arg.date.getDate()}" class="assenza relative px-5 py-1 m-1 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md dark:hover:bg-red-500 dark:hover:text-white">A</label>

                        </div>`,
                };
            },

            /*dateClick: function(info) {
                // alert('Clicked on: ' + info.dateStr);
                // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                // alert('Current view: ' + info.view.type);
                // change the day's background color just for fun
                // info.dayEl.style.backgroundColor = 'red';
                component.visModale();
            }*/
        })
        calendar.render();

        const bottoniPresenze = document.querySelectorAll('.presenza');
        bottoniPresenze.forEach(button => {
            button.addEventListener('click', function (e) {
                const date = e.target.getAttribute('data-date');
                //alert(`Bottone presenza cliccato per la data: ${date}`);
                let payload = ['P', date]
                component.selezionaPresenzaAssenza(payload);
            });
        });

        const bottoniAssenze = document.querySelectorAll('.assenza');
        bottoniAssenze.forEach(button => {
            button.addEventListener('click', function (e) {
                const date = e.target.getAttribute('data-date');
                //alert(`Bottone assenza cliccato per la data: ${date}`);
                let payload = ['A', date]
                component.selezionaPresenzaAssenza(payload);
            });
        });

    })
</script>
@endscript