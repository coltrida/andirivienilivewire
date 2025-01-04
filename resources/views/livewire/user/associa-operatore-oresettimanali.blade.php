<div>
    <form wire:submit="inserisci">
        <div class="grid gap-6 mb-6 md:grid-cols-5">
            <div>
                <select wire:model="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="">Operatore</option>
                    @foreach($listaOperatori as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input wire:model="oresettimanali" type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ore settimanali"/>
            </div>
            <div>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Inserisci
                </button>
            </div>
        </div>
    </form>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-white">
            <tr class="text-center">
                <th scope="col" class="px-6 py-3">
                    Id
                </th>
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    Ore Settimanali
                </th>
                <th scope="col" class="px-6 py-3">
                    Ore Saldo
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($listaOperatori as $item)
                <tr class="bg-white text-center dark:text-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->id}}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->name}}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$item->oresettimanali}}
                    </td>
                    <td class="px-6 py-4">
                        {{$item->oresaldo}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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

