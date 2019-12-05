@extends('layouts.app')

@section('content')

    <div id="container">

        <h1 id="pageTitle">{{$team->name}} Members</h1>

        <hr>

        <div class="well card m-3 p-3">
            <div class="team-leader">
                <h4>Team leader:</h4>
                 {{ App\User::find($team->leader_id)->name }}
            </div>
        </div>
        <div class="well card m-3 p-3">
            <div class="team-member">
                <h4>Team members :</h4>

                <!-- Member list -->
                    @foreach($team->users as $user)
                        @if($user->id != $team->leader_id) <!-- check if member is leader -->
                        <!-- Each Member -->
                                {{$user->name}}
                                    <!-- Don't display remove btn if user is leader -->
                                    @can('removeMember', $team)
                                        <button 
                                            class="remove-member btn btn-outline-danger"
                                            userId="{{$user->id}}">
                                                Remove 
                                        </button>
                                    @endcan
                            <br>
                        @endif
                    @endforeach
            </div>
        </div>

        <br>

        @can('addMember', $team)
            <!-- Button trigger newMemberModal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newMemberModal">
                Add Member
            </button>
        @endcan

        @include('modals.new_member_modal')

    </div>

@endsection