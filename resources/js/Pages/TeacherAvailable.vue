<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const form = useForm({
    teacher_id: user.teacher_id,
});

</script>

<template>
    <Head title="Привязка преподавателя" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Привязка преподавателя</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Привязка преподавателя</h2>
                            
                            <p class="mt-1 text-sm text-gray-600">
                                Введите код привязки преподавателя
                            </p>
                        </header>

                        <form @submit.prevent="form.patch(route('teacheravailable.update'))" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="teacher_id" value="Код преподавателя" />

                                <TextInput
                                    id="teacher_id"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.teacher_id"
                                    required
                                    autofocus
                                    autocomplete="teacher_id"
                                />

                                <InputError class="mt-2" :message="form.errors.teacher_id" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                </Transition>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
