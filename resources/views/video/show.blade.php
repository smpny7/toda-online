<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $video->title }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="alert" class="px-6 py-4 border-0 rounded-xl relative shadow mb-4 bg-white hidden">
                <span class="text-xl inline-block align-middle">
                    <img id="alert-failed" src="{{ asset('img/alert-circle.png') }}" class="w-1/2 hidden" alt="Alert">
                    <img id="alert-success" src="{{ asset('img/check-circle.png') }}" class="w-1/2 hidden" alt="Check">
                </span>
                <span id="alert-message" class="inline-block align-middle"></span>
                <button id="alert-hidden"
                        class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
                    <span>×</span>
                </button>
            </div>
            <div class="grid grid-cols-3 gap-6 mt-8">
                <div class="col-span-3 lg:col-span-2">
                    <div class="h-113">
                        <video id="video" src="{{ route('protection', ['video_id' => $video->id]) }}"
                               controlsList="nodownload" controls oncontextmenu="return false" preload="none"
                               class="h-full rounded-xl shadow-xl w-full focus:outline-none"
                               poster="{{ Storage::disk('local')->url('thumbnail/' . $video->id . '.jpg') }}"></video>
                    </div>
                    <div class="bg-white grid grid-cols-12 mt-7 px-1 py-6 rounded-xl shadow-md">
                        <div class="col-span-2">
                            <p class="pt-1 text-center">
                                <span
                                    class="bg-themeColor font-semibold px-4 py-1 rounded-xl text-white tracking-widest">
                                    {{ $video->class }}
                                </span>
                            </p>
                        </div>
                        <div class="col-span-9">
                            <h3 class="font-bold pl-3 text-2xl tracking-widest">{{ $video->title }}</h3>
                            <div class="mt-3 pl-3">
                                <img src="{{ asset('img/file.png') }}" class="align-middle inline-block w-5" alt="File">
                                <span
                                    class="align-middle font-semibold inline-block ml-2 text-gray-500 text-md">
                                    {{ FileSizeConversion::formatBytes($video->filesize) }}
                                </span>
                                <img src="{{ asset('img/clock.png') }}" class="align-middle inline-block ml-5 w-5"
                                     alt="Clock">
                                <span
                                    class="align-middle font-semibold inline-block ml-2 text-gray-500 text-md">
                                        {{ TimeConversion::fromSecondsToMinutes($video->duration) }}
                                </span>
                                <img
                                    src="@isset($video->watched) {{ asset('img/eye.png') }} @else {{ asset('img/eye-off.png') }} @endisset"
                                    class="align-middle inline-block ml-5 w-5" alt="Eye">
                                <span
                                    class="align-middle font-semibold inline-block ml-2 text-gray-500 text-sm">
                                        @isset($video->watched) 視聴済み @else 未視聴 @endisset
                                </span>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <form class="h-1/2 ml-3 relative w-1/2 watch_later"
                                  action="{{ route('switchBookmark', ['video_id' => $video->id]) }}" method="POST">
                                <input id="bookmark" type="checkbox" class="absolute h-full opacity-0 w-full"
                                       @if($bookmarked) checked @endif disabled>
                                <label for="bookmark" style="background-size: 30px"
                                       class="bg-bookmark selected-sibling:bg-bookmark-f bg-no-repeat bg-left-top h-full inline-block w-full"></label>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-white col-span-3 lg:col-span-1 h-150 relative rounded-xl shadow-md">
                    <div class="absolute bg-white border-b-2 border-gray-200 h-16 rounded-t-xl top-0 w-full z-10">
                        <span class="inline-block ml-7 mt-5 tracking-widest text-lg">コミュニティ</span>
                    </div>
                    <div id="message" class="h-120 mt-16 overflow-y-scroll py-4 relative">
                        @if($comment_count == 0)
                            <img src="{{ asset('img/no-message.png') }}"
                                 class="absolute bottom-0 left-0 m-auto right-0 top-0 w-1/2" alt="NoMessage">
                        @else
                            @for($i=0; $i<$comment_count; $i++)
                                <div class="animate-pulse flex mb-3">
                                    <div class="bg-orange-100 flex-none inline-block h-12 ml-3 rounded-full w-12"></div>
                                    <div class="flex-grow pl-4 pr-2">
                                        <div>
                                            <div class="bg-orange-100 h-3 inline-block rounded w-1/4"></div>
                                            <div class="bg-orange-100 h-3 inline-block rounded pl-2 w-1/6"></div>
                                        </div>
                                        <p class="bg-orange-100 h-5 inline-block rounded w-11/12"></p>
                                    </div>
                                </div>
                            @endfor
                        @endif
                    </div>
                    <div class="absolute bottom-0 bg-white h-16 rounded-b-xl w-full z-10">
                        <form class="mt-3 relative"
                              action="{{ route('createComment', ['video_id' => $video->id]) }}" method="POST">
                            <input id="input-comment" name="message" type="text" placeholder="メッセージを送信" required
                                   class="absolute bg-gray-100 h-10 left-0 m-auto pl-5 pr-10 right-0 rounded-xl text-gray-600 text-sm w-11/12 focus:outline-none">
                            <button id="create-comment" type="submit" class="absolute right-3 top-3 focus:outline-none">
                                <img src="{{ asset('img/send.png') }}" class="w-1/2" alt="Send">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            getMessages();
            $('#bookmark').prop('disabled', false);

            $(function () {
                $('#alert-hidden').on('click', function () {
                    hiddenAlert();
                });

                $('#bookmark').change(function () {
                    switchBookmark();
                });

                $('#create-comment').on('click', function (event) {
                    event.preventDefault();
                    sendMessage();
                });
            });

            function hiddenAlert() {
                $('#alert-message').text('');
                $('#alert').addClass('hidden');
                $('#alert-failed').addClass('hidden');
                $('#alert-success').addClass('hidden');
            }

            function switchBookmark() {
                $form = $('#bookmark').parents('form:first');

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

            function getMessages() {
                moment.locale('ja');
                $.ajax({
                    url: '{{ route('getComments', ['video_id' => $video->id]) }}', //送信先
                    type: 'POST', //送信方法
                    datatype: 'json', //受け取りデータの種類
                    success: function (result) {
                        console.log((jQuery.parseJSON(result).comments.length));
                        const messages = jQuery.parseJSON(result).success ?
                            jQuery.parseJSON(result).comments.length ?
                                jQuery.parseJSON(result).comments.map(row => `
                                    <div class="flex mb-3">
                                        <img src="${row.user.profile_photo_url}" class="flex-none h-12 ml-3 rounded-full w-12" alt="Icon">
                                        <div class="flex-grow pl-4 pr-2">
                                            <p>
                                                <span class="text-gray-500 text-xs tracking-widest">${row.user.name}</span>
                                                <span class="pl-2 text-gray-500 text-xxs tracking-wider">${moment.utc(row.created_at, 'YYYY/MM/DD HH:mm:S').fromNow()}</span>
                                            </p>
                                            <p class="text-sm">${row.message}</p>
                                        </div>
                                    </div>
                                `)
                                : `<img src="{{ asset('img/no-message.png') }}" class="absolute bottom-0 left-0 m-auto right-0 top-0 w-1/2" alt="NoMessage">`
                            : `<img src="{{ asset('img/failed-message.png') }}" class="absolute bottom-0 left-0 m-auto right-0 top-0 w-1/2" alt="FailedMessage">`;

                        $('#message').html(messages);

                        console.log('通信成功');
                        // console.log(result);
                        messageScroll();
                    },
                    error: function () {
                        // $('#result').html(data);
                        console.log('通信失敗');
                    }
                });
            }

            function sendMessage() {
                $form = $('#create-comment').parents('form:first');

                if ($('#input-comment').val() === '') {
                    $('#alert-message').text('メッセージを入力してください');
                    $('#alert-failed').removeClass('hidden');
                    $('#alert-success').addClass('hidden');
                    $('#alert').removeClass('hidden');
                    return
                }

                $.ajax({
                    url: $form.attr('action'), //Formのアクションを取得して指定する
                    type: $form.attr('method'),//Formのメソッドを取得して指定する
                    data: $form.serialize(),　 //データにFormがserialzeした結果を入れる
                    timeout: 10000,
                    beforeSend: function () {
                        //Buttonを無効にする
                        $('#create-comment').attr('disabled', true);
                        $('#input-comment').val('');
                        //処理中のを通知するアイコンを表示する
                        // $('#create-comment').append('<div class="overlay" id ="spin" name = "spin"><i class="fa fa-refresh fa-spin"></i></div>');
                    },
                    complete: function () {
                        //処理中アイコン削除
                        // $('#spin').remove();
                        $('#create-comment').attr('disabled', false);
                    },
                    success: function (result) {
                        //Alertで送信結果を表示する
                        if (jQuery.parseJSON(result).success) {
                            $('#alert-message').text('メッセージを送信しました');
                            $('#alert-failed').addClass('hidden');
                            $('#alert-success').removeClass('hidden');
                        } else {
                            $('#alert-message').text('メッセージの送信に失敗しました');
                            $('#alert-failed').removeClass('hidden');
                            $('#alert-success').addClass('hidden');
                        }
                        $('#alert').removeClass('hidden');

                        getMessages();

                        setTimeout(() => {
                            hiddenAlert();
                        }, 3000);
                    },
                    error: function () {
                        $('#create-comment').attr('disabled', false);
                        $('#alert-message').text('メッセージの送信に失敗しました');
                        $('#alert-failed').removeClass('hidden');
                        $('#alert-success').addClass('hidden');
                        $('#alert').removeClass('hidden');

                        getMessages();

                        setTimeout(() => {
                            hiddenAlert();
                        }, 3000);
                    }
                });
            }

            function messageScroll() {
                $('#message').animate({scrollTop: $('#message')[0].scrollHeight}, 'fast');
            }
        });
    </script>
</x-app-layout>
