<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/Auth/RegisteredChildController';
import { login } from '@/routes';

defineProps<{ birthYears: number[] }>();
</script>

<template>
    <main class="flex min-h-screen items-center justify-center p-6">
        <Head title="Inscription" />

        <div class="w-full max-w-sm">
            <h1 class="text-2xl font-semibold">Inscription</h1>
            <p class="mt-1 text-sm text-gray-500">
                Le Père Noël t'offre des bons points à l'inscription.
            </p>

            <Form
                v-bind="store.form()"
                #default="{ errors, processing }"
                class="mt-6 flex flex-col gap-4"
            >
                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm font-medium">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        autocomplete="email"
                        required
                        class="rounded-md border px-3 py-2"
                    />
                    <p v-if="errors.email" class="text-sm text-red-600">
                        {{ errors.email }}
                    </p>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="birth_year" class="text-sm font-medium"
                        >Année de naissance</label
                    >
                    <select
                        id="birth_year"
                        name="birth_year"
                        required
                        class="rounded-md border px-3 py-2"
                    >
                        <option
                            v-for="year in birthYears"
                            :key="year"
                            :value="year"
                        >
                            {{ year }}
                        </option>
                    </select>
                    <p v-if="errors.birth_year" class="text-sm text-red-600">
                        {{ errors.birth_year }}
                    </p>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="contact" class="text-sm font-medium"
                        >Contact</label
                    >
                    <input
                        id="contact"
                        name="contact"
                        type="text"
                        required
                        class="rounded-md border px-3 py-2"
                    />
                    <p v-if="errors.contact" class="text-sm text-red-600">
                        {{ errors.contact }}
                    </p>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password" class="text-sm font-medium"
                        >Mot de passe</label
                    >
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        required
                        class="rounded-md border px-3 py-2"
                    />
                    <p v-if="errors.password" class="text-sm text-red-600">
                        {{ errors.password }}
                    </p>
                </div>

                <div class="flex flex-col gap-1">
                    <label
                        for="password_confirmation"
                        class="text-sm font-medium"
                        >Confirmation</label
                    >
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        required
                        class="rounded-md border px-3 py-2"
                    />
                </div>

                <button
                    type="submit"
                    :disabled="processing"
                    class="rounded-md bg-red-700 px-4 py-2 text-white disabled:opacity-50"
                >
                    {{ processing ? 'Inscription...' : "S'inscrire" }}
                </button>
            </Form>

            <p class="mt-6 text-sm text-gray-500">
                Déjà inscrit ?
                <Link :href="login()" class="font-medium text-red-700 underline"
                    >Se connecter</Link
                >
            </p>
        </div>
    </main>
</template>
