<div class="card">
    <div class="card-body table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th class="text-left" scope="col">Country</th>
                    <th class="text-left" scope="col">League / Cup</th>
                </tr>
            </thead>
            <tbody>
                @php
                $i = 0;
                @endphp
                @foreach ($leagues_ordered as $key => $leagues_ordered_value)
                @php
                $i++;
                @endphp
                <tr>
                    <th scope="row" style="width: 25% !important">
                        {{$i}}
                    </th>
                    <td class="text-left" style="width: 35% !important">
                        @if ($leagues[$key]->country->flag)
                        <img width="14%" src="{{$leagues[$key]->country->flag}}" alt="">
                        @endif
                        {{$leagues[$key]->country->name}}
                    </td>
                    <td class="text-left" style="width: 40% !important">
                        <a class="no-underline"
                            href="{{route('public.league.get', ['nation' => str_replace(' ','_', $leagues[$key]->country->name), 'league_name' => str_replace(' ','_', $leagues[$key]->league->name)])}}">
                            <img width="14%" src="{{$leagues[$key]->league->logo}}" alt="">
                            {{$leagues[$key]->league->name}}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.table').DataTable({
            language: {
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            }
        });

    });

</script>
