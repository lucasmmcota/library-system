<div class="table-responsive">
    <table class="table bordered">
        <thead>
            <tr>
                @foreach ($arrayHeader as $header)
                    <th class="text-center">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($arrayData as $data)
                @php $arrayModal = []; @endphp

                <tr>
                    @foreach ($data as $value)
                        <td class="text-center">
                            @if (is_array($value))
                                @php $arrayModal[] = $value; @endphp
                                @include('components.icon', $value)
                            @else
                                {{ $value }}
                            @endif
                        </td>
                    @endforeach
                </tr>

                @foreach ($arrayModal as $modal)
                    @if (!empty($modal['dataTarget']))
                        @include(
                            'components.modal_confirm',
                            [
                                'userId' => $modal['id'],
                                'title' => $modal['title'],
                                'idModal' => substr($modal['dataTarget'], 1),
                                'route' => $modal['route'],
                                'method' => $modal['method'],
                                'message' => $modal['message']
                            ]
                        )
                    @endif
                @endforeach

            @endforeach
        </tbody>
    </table>
</div>
