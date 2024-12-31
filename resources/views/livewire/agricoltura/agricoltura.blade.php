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
                <select wire:model="client_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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

    {{--@if($visualizzaModale)
    <div x-data="{ open: true }" id="modale">
        <!-- Finestra fissa -->
        <div x-show="open" x-transition class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-black rounded-lg w-96 h-72 overflow-hidden shadow-lg">
                <!-- Header della finestra -->
                <div class="flex justify-between items-center p-4 border-b">
                    <h2 class="text-lg font-semibold">Lista Ragazzi</h2>
                    <button wire:click=nasModale() class="text-red-500">Chiudi</button>
                </div>

                <!-- Lista con scorrimento -->
                <div class="p-4 overflow-y-auto h-56">
                    <h2>prova</h2>
                </div>
            </div>
        </div>
    </div>
    @endif--}}

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

        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            height: 520,
            locale: 'it',
            firstDay: 1,
            initialView: 'dayGridMonth',
/*            selectable: true,*/

            dayCellContent: function (arg) {
                // Personalizza il contenuto della cella
                return {
                    html: `<div style="display: flex!important; justify-content: space-between!important;">
                                <div style="margin: 0 20px; color: white">${arg.date.getDate()}</div>
                                <div>
                                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-teal-300 to-lime-300 group-hover:from-teal-300 group-hover:to-lime-300 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-lime-200 dark:focus:ring-lime-800" data-date="${arg.date.toISOString()}">
                                        <span class="presenza relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                        P
                                        </span>
                                    </button>
                                </div>
                                <div>
                                    <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200 dark:text-white dark:hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400" data-date="${arg.date.toISOString()}">
                                        <span class="assenza relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                                        A
                                        </span>
                                    </button>
                                </div>
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

        // Aggiungi un evento click ai bottoni
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('presenza')) {
                const date = e.target.getAttribute('data-date');
                 //alert(`Bottone presenza cliccato per la data: ${date}`);
                component.selezionaPresenzaAssenza('P');
            } else
            {
                const date = e.target.getAttribute('data-date');
                 //alert(`Bottone assenza cliccato per la data: ${date}`);
                component.selezionaPresenzaAssenza('A');
            }
        });
    })
</script>
@endscript
