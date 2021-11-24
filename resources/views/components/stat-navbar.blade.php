<div class="flex">
    <a href="{{ route('profile', $user->username) }}" class="px-8 py-4 text-center font-semibold border-r border-l">
        <div class="font-semibold text-2xl">{{ $user->statuses->count() }}</div>
        <div class="uppercase text-xs text-gray-600">Status</div>
    </a>
    <a href="{{ route('profile.followers', [$user->username, 'followers']) }}" class="px-8 py-4 text-center font-semibold border-r">
        <div class="font-semibold text-2xl">{{ $user->followers->count() }}</div>
        <div class="uppercase text-xs text-gray-600">Followers</div>
    </a>
    <a href="{{ route('profile.followers', [$user->username, 'following']) }}" class="px-8 py-4 text-center font-semibold border-r">
        <div class="font-semibold text-2xl">{{ $user->follows->count() }}</div>
        <div class="uppercase text-xs text-gray-600">Following</div>
    </a>
</div>
