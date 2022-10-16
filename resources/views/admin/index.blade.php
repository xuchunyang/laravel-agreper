<x-admin-layout>
    <x-slot:title>
        管理面板
    </x-slot:title>

    <h1>管理面板</h1>

    <p>
        <a href="/admin">管理面板</a>
        <a href="/">首页</a>
    </p>

    @if(session('success'))
        <p class="flash success">{{ session('success') }}</p>
    @endif

    <h2>SQL 查询</h2>
    <p>⚠ 请确保您已经知道执行该 SQL 查询的后果！ ⚠</p>
    <x-admin-query-form/>

    <h2>网站配置</h2>
    <form action="{{ route('admin.update-setting', ['setting' => $setting]) }}" method="post">
        @csrf
        @method('PATCH')
        <table>
            <tbody>
            <tr>
                <td><label for="website-name">网站名称</label></td>
                <td>
                    <input
                        type="text"
                        id="website-name"
                        name="name"
                        value="{{ $errors->setting->any() ? old('name', $setting->name) : $setting->name}}">
                    @error('name', 'setting')
                    <span class="validation-error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="website-description">网站描述</label></td>
                <td>
                    <textarea
                        id="website-description"
                        name="description"
                    >{{ $errors->setting->any() ? old('description', $setting->description) : $setting->description }}</textarea>
                    @error('description', 'setting')
                    <span class="validation-error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>是否允许注册?</td>
                <td>
                    @php
                        $registration_enabled_checked = $errors->setting->any() ?
                            old('registration_enabled', $setting->registration_enabled) :
                            $setting->registration_enabled;
                    @endphp
                    <label>
                        <input
                            type="radio"
                            name="registration_enabled"
                            value="1"
                            @checked($registration_enabled_checked)>
                        允许
                    </label>
                    <label>
                        <input
                            type="radio"
                            name="registration_enabled"
                            value="0"
                            @checked(!$registration_enabled_checked)>
                        不允许
                    </label>

                    @error('registration_enabled', 'setting')
                    <span class="validation-error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            </tbody>
        </table>
        <p>
            <input type="submit" value="更新">
        </p>
    </form>

    <h2>论坛管理</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Models\Forum::all() as $forum)
            <tr>
                <td>{{ $forum->id }}</td>
                <td>
                    <form action="{{ route('admin.forum.name', ['forum' => $forum]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <input
                            type="text"
                            name="name"
                            value="{{ $errors->{'forumName' . $forum->id}->any() ? old('name', $forum->name) : $forum->name }}">
                        @error('name', 'forumName' . $forum->id)
                        <span class="validation-error">{{ $message }}</span>
                        @enderror
                        <input type="submit" value="更新名称">
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.forum.description', ['forum' => $forum]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <textarea
                            name="description">{{ $errors->{'forumDescription' . $forum->id}->any() ? old('description', $forum->description) : $forum->description }}</textarea>
                        @error('description', 'forumDescription' . $forum->id)
                        <span class="validation-error">{{ $message }}</span>
                        @enderror
                        <input type="submit" value="更新描述">
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.forum.delete', ['forum' => $forum]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="删除">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3>添加论坛</h3>
    <form action="{{ route('admin.forum.store') }}" method="post">
        @csrf
        <table>
            <tbody>
            <tr>
                <td><label for="new-forum-name">名称</label></td>
                <td>
                    <input
                        type="text"
                        id="new-forum-name"
                        name="name"
                        value="{{ $errors->newForum->any() ? old('name') : '' }}">
                    @error('name', 'newForum')
                    <span class="validation-error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="new-forum-description">简介</label></td>
                <td>
                    <textarea
                        id="new-forum-description"
                        name="description"
                    >{{ $errors->newForum->any() ? old('description') : '' }}</textarea>
                    @error('description', 'newForum')
                    <span class="validation-error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            </tbody>
        </table>
        <p>
            <input type="submit" value="添加论坛">
        </p>
    </form>

    <h2>用户</h2>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>角色</th>
            <th>加入时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Models\User::all() as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <form action="{{ route('admin.user.role', ['user' => $user]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <select name="role">
                            @foreach(\App\Models\User::$roles as $role)
                                <option @selected($role === $user->role)>{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('role', 'setRole' . $user->id)
                        <span class="validation-error">{{ $message }}</span>
                        @enderror
                        <input type="submit" name="设置角色">
                    </form>
                </td>
                <td>{{ $user->created_at->longRelativeToNowDiffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h3>添加用户</h3>
    <form action="{{ route('admin.user.store') }}" method="post">
        @csrf
        <table>
            <tbody>
            <tr>
                <td><label for="user-name">名称</label></td>
                <td>
                    <input
                        type="text"
                        id="user-name"
                        name="name"
                        value="{{ $errors->user->any() ? old('name') : ''}}">
                    @error('name', 'user')
                    <span class="validation-error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td><label for="user-password">密码</label></td>
                <td>
                    <input
                        type="password"
                        id="user-password"
                        name="password">
                    @error('password', 'user')
                    <span class="validation-error">{{ $message }}</span>
                    @enderror
                </td>
            </tr>
            </tbody>
        </table>
        <p><input type="submit" value="创建用户"></p>
    </form>
</x-admin-layout>
