<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/Auth/ChildSessionController';
import { register } from '@/routes';
</script>

<template>
    <main class="flex min-h-screen items-center justify-center p-6">
        <Head title="Connexion" />

        <div class="w-full max-w-sm">
            <h1 class="text-2xl font-semibold">Connexion</h1>
            <p class="mt-1 text-sm text-gray-500">
                Retrouve ta liste de souhaits.
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

                <label class="flex items-center gap-2 text-sm">
                    <input name="remember" type="checkbox" value="1" />
                    Se souvenir de moi
                </label>

                <button
                    type="submit"
                    :disabled="processing"
                    class="rounded-md bg-red-700 px-4 py-2 text-white disabled:opacity-50"
                >
                    {{ processing ? 'Connexion...' : 'Se connecter' }}
                </button>
            </Form>

            <p class="mt-6 text-sm text-gray-500">
                Pas encore inscrit ?
                <Link
                    :href="register()"
                    class="font-medium text-red-700 underline"
                    >Créer un compte</Link
                >
            </p>
        </div>
    </main>
</template>
