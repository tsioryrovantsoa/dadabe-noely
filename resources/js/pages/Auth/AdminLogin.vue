<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/Auth/AdminSessionController';
</script>

<template>
    <main class="flex min-h-screen items-center justify-center bg-bark p-6">
        <Head title="Connexion administrateur" />

        <div class="w-full max-w-sm rounded-cozy bg-cream p-8 shadow-lg">
            <h1 class="font-display text-2xl font-bold text-bark">
                Administration
            </h1>
            <p class="mt-1 text-sm text-bark-soft">
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
                        class="rounded-xl border border-cream-dark bg-white px-4 py-2.5 focus:border-pine focus:outline-none"
                    />
                    <p v-if="errors.login" class="text-sm text-berry">
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
                        class="rounded-xl border border-cream-dark bg-white px-4 py-2.5 focus:border-pine focus:outline-none"
                    />
                    <p v-if="errors.password" class="text-sm text-berry">
                        {{ errors.password }}
                    </p>
                </div>

                <button
                    type="submit"
                    :disabled="processing"
                    class="rounded-cozy bg-pine px-6 py-3 font-display font-semibold text-cream hover:bg-pine-dark disabled:opacity-50"
                >
                    {{ processing ? 'Connexion...' : 'Se connecter' }}
                </button>
            </Form>
        </div>
    </main>
</template>
