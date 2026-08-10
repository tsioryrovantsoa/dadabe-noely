<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import { store } from '@/actions/App/Http/Controllers/Auth/RegisteredChildController';
import ChristmasLayout from '@/layouts/ChristmasLayout.vue';
import { login } from '@/routes';

defineOptions({ layout: ChristmasLayout });

defineProps<{ birthYears: number[] }>();
</script>

<template>
    <Head title="Inscription" />

    <div class="mx-auto max-w-md rounded-cozy bg-white p-8 shadow-sm">
        <h1 class="font-display text-3xl font-bold text-berry">Inscription</h1>
        <p class="mt-1 text-sm text-bark-soft">
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
                    class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
                />
                <p v-if="errors.email" class="text-sm text-berry">
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
                    class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
                >
                    <option
                        v-for="year in birthYears"
                        :key="year"
                        :value="year"
                    >
                        {{ year }}
                    </option>
                </select>
                <p v-if="errors.birth_year" class="text-sm text-berry">
                    {{ errors.birth_year }}
                </p>
            </div>

            <div class="flex flex-col gap-1">
                <label for="contact" class="text-sm font-medium">Contact</label>
                <input
                    id="contact"
                    name="contact"
                    type="text"
                    required
                    class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
                />
                <p v-if="errors.contact" class="text-sm text-berry">
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
                    class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
                />
                <p v-if="errors.password" class="text-sm text-berry">
                    {{ errors.password }}
                </p>
            </div>

            <div class="flex flex-col gap-1">
                <label for="password_confirmation" class="text-sm font-medium"
                    >Confirmation</label
                >
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    required
                    class="rounded-xl border border-cream-dark px-4 py-2.5 focus:border-pine focus:outline-none"
                />
            </div>

            <button
                type="submit"
                :disabled="processing"
                class="rounded-cozy bg-berry px-6 py-3 font-display font-semibold text-cream hover:bg-berry-dark disabled:opacity-50"
            >
                {{ processing ? 'Inscription...' : "S'inscrire" }}
            </button>
        </Form>

        <p class="mt-6 text-sm text-bark-soft">
            Déjà inscrit ?
            <Link :href="login()" class="font-medium text-berry underline"
                >Se connecter</Link
            >
        </p>
    </div>
</template>
