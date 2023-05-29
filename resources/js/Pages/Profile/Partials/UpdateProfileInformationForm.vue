<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    surname: user.surname,
    teacher_id: (user.teacher_id != '') ? user.teacher_id : '',
    role: (user.role == 'teacher') ? 1 : 0,
    email: user.email,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Информация профиля</h2>
            
            <p class="mt-1 text-sm text-gray-600">
                Обновите информацию профиля вашей учетной записи и адрес электронной почты.
            </p>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <div>
                <InputLabel for="name" value="Имя" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="surname" value="Фамилия" />

                <TextInput
                    id="surname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.surname"
                    required
                    autocomplete="surname"
                />

                <InputError class="mt-2" :message="form.errors.surname" />
            </div>

            <div v-if="user.role=='user'">
                <InputLabel for="teacher_id" value="Идентификатор учителя" />

                <TextInput
                    id="teacher_id"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.teacher_id"
                    required
                    autocomplete="teacher_id"
                />

                <InputError class="mt-2" :message="form.errors.teacher_id" />
            </div>

            <fieldset class="mt-2">
                <legend class="block font-medium text-sm text-gray-700">Выберите, кем вы являетесь:</legend>

                <div>
                    <input type="radio" id="user" value="0" v-model="form.role" class="outline-none active:outline-none active:bg-emerald-600 hover:bg-emerald-600 focus:outline-none focus:ring focus:bg-emerald-600 focus-within:bg-emerald-600 focus-visible:bg-emerald-600 checked:bg-emerald-600"/>
                    <label class="ml-2 nb-2 text-gray-700" for="user">Ученик</label>
                </div>

                <div>
                    <input type="radio" id="teacher" value="1" v-model="form.role" class="outline-none active:outline-none active:bg-emerald-600 hover:bg-emerald-600 focus:outline-none focus:ring focus:bg-emerald-600 focus-within:bg-emerald-600 focus-visible:bg-emerald-600 checked:bg-emerald-600"/>
                    <label class="ml-2 nb-2 text-gray-700" for="teacher">Учитель</label>
                </div>

            </fieldset>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Ваш адрес электронной почты не подтвержден.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500"
                    >
                        Нажмите здесь, чтобы повторно отправить электронное письмо с подтверждением.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    На ваш адрес электронной почты была отправлена новая ссылка для подтверждения.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Сохранено.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
