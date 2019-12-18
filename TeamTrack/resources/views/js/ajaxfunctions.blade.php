@include('js.ajax.csrf')

{{-- Navigation --}}
@include('js.ajax.navigation')

{{-- Task functions --}}
@include('js.ajax.createSprint')
@include('js.ajax.deleteSprint')
@include('js.ajax.createTask')
@include('js.ajax.editTask')
@include('js.ajax.reassignTask')
@include('js.ajax.rescheduleTask')
@include('js.ajax.deleteTask')
@include('js.ajax.toggleIsCompleted')

{{-- Member functions --}}
@include('js.ajax.addMember')
@include('js.ajax.removeMember')