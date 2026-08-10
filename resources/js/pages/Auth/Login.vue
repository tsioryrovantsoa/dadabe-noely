<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/Auth/ChildSessionController';
import ChristmasLayout from '@/layouts/ChristmasLayout.vue';
import { register } from '@/routes';

defineOptions({ layout: ChristmasLayout });
</script>

<template>
    <Head title="Connexion" />

    <div class="mx-auto max-w-md rounded-cozy bg-white p-8 shadow-sm">
        <h1 class="font-display text-3xl font-bold text-berry">Connexion</h1>
        <p class="mt-1 text-sm text-bark-soft">
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
                    class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
                />
                <p v-if="errors.email" class="text-sm text-berry">
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
                    class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
                />
                <p v-if="errors.password" class="text-sm text-berry">
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
                class="rounded-cozy bg-berry px-6 py-3 font-display font-semibold text-cream hover:bg-berry-dark disabled:opacity-50"
            >
                {{ processing ? 'Connexion...' : 'Se connecter' }}
            </button>
        </Form>

        <p class="mt-6 text-sm text-bark-soft">
            Pas encore inscrit ?
            <Link :href="register()" class="font-medium text-berry underline"
                >Créer un compte</Link
            >
        </p>
    </div>
</template>
