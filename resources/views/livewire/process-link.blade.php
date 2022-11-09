<form >
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
            PAYMENT LINK
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
               wire:model="payment_link"
               id="payment_link"
               type="password"
               placeholder=" https://******.***/************"
        >
    </div>
    <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
            BYPASS LINK
        </label>
        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
               id="bypass_link"
               type="text"
               placeholder=" https://sfnaus.asdavzu.nst/daxasd/sdxtrx"
               value="{{$bypass}}"
        >
    </div>

</form>
<div class="flex items-center justify-end text-right">
    <button
        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
        data-clipboard-target="#bypass_link">Copy link to Clipboard
    </button>
</div>


