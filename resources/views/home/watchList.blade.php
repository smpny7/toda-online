<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ウォッチリスト') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-8">
            <div id="alert" class="px-6 py-4 border-0 sm:rounded-xl relative shadow mb-4 mt-4 sm:mt-0 bg-white hidden">
                <span class="text-xl inline-block align-middle">
                    <img id="alert-failed" src="{{ asset('img/alert-circle.png') }}" class="w-1/2 hidden" alt="Alert">
                    <img id="alert-success" src="{{ asset('img/check-circle.png') }}" class="w-1/2 hidden" alt="Check">
                </span>
                <span id="alert-message" class="inline-block align-middle text-sm"></span>
                <button id="alert-hidden"
                        class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
                    <span>×</span>
                </button>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4 sm:mt-8">
                @foreach($videos as $video)
                    @include('components.video-card', ['video' => $video])
                @endforeach
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("pageshow", function (event) {
            const historyTraversal = event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2);
            if (historyTraversal) window.location.reload();
        });
    </script>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function hiddenAlert() {
        $('#alert-message').text('');
        $('#alert').addClass('hidden');
        $('#alert-failed').addClass('hidden');
        $('#alert-success').addClass('hidden');
    }

    function switchBookmark(id) {
        $form = $('#bookmark_' + id).parents('form:first');

        $.ajax({
            url: $form.attr('action'), //Formのアクションを取得して指定する
            type: $form.attr('method'),//Formのメソッドを取得して指定する
            data: $form.serialize(),　 //データにFormがserialzeした結果を入れる
            timeout: 10000,
            success: function (result) {
                console.log(result);
                //Alertで送信結果を表示する
                if (jQuery.parseJSON(result).success) {
                    if (jQuery.parseJSON(result).registered)
                        $('#alert-message').text('ウォッチリストに追加しました');
                    else
                        $('#alert-message').text('ウォッチリストから削除しました');
                    $('#alert-failed').addClass('hidden');
                    $('#alert-success').removeClass('hidden');
                } else {
                    $('#alert-message').text('ウォッチリストの反映に失敗しました');
                    $('#alert-failed').removeClass('hidden');
                    $('#alert-success').addClass('hidden');
                }
                $('#alert').removeClass('hidden');

                setTimeout(() => {
                    hiddenAlert();
                }, 3000);
            },
            error: function () {
                $('#create-comment').attr('disabled', false);
                $('#alert-message').text('ウォッチリストの反映に失敗しました');
                $('#alert-failed').removeClass('hidden');
                $('#alert-success').addClass('hidden');
                $('#alert').removeClass('hidden');

                setTimeout(() => {
                    hiddenAlert();
                }, 3000);
            }
        });
    }
</script>
