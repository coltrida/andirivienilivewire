<div>
    {{--<form class="max-w-md mx-auto" wire:submit="modifica">
        <div class="">
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
                <input type="email" wire:model="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
            </div>
            <div class="mb-5">
                <label for="oresettimanali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ore settimanali</label>
                <input type="text" wire:model="oresettimanali" id="oresettimanali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
        </div>

        <div class="mt-6">
          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Modifica
          </button>
--}}{{--          <a href="{{route('lista-operatori')}}" wire:navigate  class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 w-full sm:w-auto font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Annulla</a>--}}{{--

            <a href="{{route('lista-operatori')}}" wire:navigate class="mt-5 bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-lg w-full sm:w-auto text-center inline-block">
                Annulla
            </a>
        </div>
    </form>--}}


    <form wire:submit="modifica">
        <div class="grid gap-6 md:grid-cols-5">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
                <input type="email" wire:model="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nome vettura" required />
            </div>
            <div>
                <label for="oresettimanali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ore settimanali</label>
                <input type="text" wire:model="oresettimanali" id="oresettimanali" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nome vettura" required />
            </div>
            <div>
                <label for="oresaldo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ore saldo</label>
                <input type="text" wire:model="oresaldo" id="oresaldo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nome vettura" required />
            </div>
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">&nbsp;</label>
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Modifica
                </button>

                <a href="{{route('lista-operatori')}}" wire:navigate class="bg-yellow-400 hover:bg-yellow-500 text-white py-2 px-4 rounded-lg w-full sm:w-auto text-center inline-block">
                    Annulla
                </a>
            </div>
        </div>
    </form>

</div>
