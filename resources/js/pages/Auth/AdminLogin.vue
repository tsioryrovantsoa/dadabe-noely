<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/Auth/AdminSessionController';
</script>

<template>
    <main class="flex min-h-screen items-center justify-center p-6">
        <Head title="Connexion administrateur" />

        <div class="w-full max-w-sm">
            <h1 class="text-2xl font-semibold">Administration</h1>
            <p class="mt-1 text-sm text-gray-500">
                Espace réservé aux lutins du Père Noël.
            </p>

            <Form
                v-bind="store.form()"
                #default="{ errors, processing }"
                class="mt-6 flex flex-col gap-4"
            >
                <div class="flex flex-col gap-1">
                    <label for="login" class="text-sm font-medium">Login</label>
                    <input
                        id="login"
                        name="login"
                        type="text"
                        autocomplete="username"
                        required
                        class="rounded-md border px-3 py-2"
                    />
                    <p v-if="errors.login" class="text-sm text-red-600">
                        {{ errors.login }}
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
                        autocomplete="current-password"
                        required
                        class="rounded-md border px-3 py-2"
                    />
                    <p v-if="errors.password" class="text-sm text-red-600">
                        {{ errors.password }}
                    </p>
                </div>

                <button
                    type="submit"
                    :disabled="processing"
                    class="rounded-md bg-green-800 px-4 py-2 text-white disabled:opacity-50"
                >
                    {{ processing ? 'Connexion...' : 'Se connecter' }}
                </button>
            </Form>
        </div>
    </main>
</template>
