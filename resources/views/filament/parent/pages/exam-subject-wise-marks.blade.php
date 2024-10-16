@php use App\Models\Exammark; @endphp
<x-filament-panels::page>
    <div class="ls-cards-holder">
        <div class="ls-card">
            <div class="ls-card-body">
                <form class="max-w-sm mx-auto">
                    <label for="classes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Subject</label>
                    <select wire:model.change="selectedSubject" id="classes" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="0" selected>Select</option>
                        @foreach($this->getAllExamsSubjects() as $subject)
                            <option wire:key="{{ $subject }}" value="{{ trim($subject) }}">{{ ucwords($subject) }} </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
    @livewire(\App\Filament\Parent\Widgets\ExamSubjectWiseMarksChart::class)
    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
        <table class="fi-ta-table w-full text-sm text-left rtl:text-right text-gray-800 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Exam
                </th>
                <th scope="col" class="px-6 py-3">
                    Subject
                </th>
                <th scope="col" class="px-6 py-3">
                    Max Marks
                </th>
                <th scope="col" class="px-6 py-3">
                    Marks Obtd
                </th>
                <th scope="col" class="px-6 py-3">
                    %
                </th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($this->getMarksForSelectedSubject())&&!empty($this->selectedSubject))
                @foreach($this->getMarksForSelectedSubject() as $row)
                    @if(array_key_exists($this->selectedSubject, $row->maxmarks))
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-800 whitespace-nowrap dark:text-white">
                                {{$row->examname}}
                        </td>
                            <td class="px-6 py-4">
                                {{ucwords($this->selectedSubject)}}
                            </td>
                        <td class="px-6 py-4">
                            {{ $row->maxmarks[$this->selectedSubject] }}
                        </td>
                            @if(array_key_exists($this->selectedSubject, (array)$this->getSubjectObtainedMarksAsPerExam($row->id)?->marksobtained))
                                <td class="px-6 py-4">
                                {{$this->getSubjectObtainedMarksAsPerExam($row->id)?->marksobtained[$this->selectedSubject]}}
                                </td>
                                <td class="px-6 py-4">
                                    {{round((int)$this->getSubjectObtainedMarksAsPerExam($row->id)?->marksobtained[$this->selectedSubject]/(int)$row->maxmarks[$this->selectedSubject]*100, 2)}}
                                </td>
                            @else
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4"></td>
                            @endif
                    </tr>
                    @endif
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
{{--    {{$this->getMarksForSelectedSubject()}}--}}
@livewire(\App\Filament\Parent\Widgets\PerformanceIndicatorWidget::class)
</x-filament-panels::page>