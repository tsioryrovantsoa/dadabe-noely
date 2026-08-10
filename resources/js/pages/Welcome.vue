<script setup lang="ts">
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ChristmasLayout from '@/layouts/ChristmasLayout.vue';
import { register } from '@/routes';

defineOptions({ layout: ChristmasLayout });

const page = usePage();

const child = computed(() => page.props.auth.child);
</script>

<template>
    <Head title="Accueil" />

    <section class="mx-auto max-w-2xl text-center">
        <h1 class="font-display text-5xl font-bold text-berry">
            Écris au Père Noël
        </h1>
        <p class="mt-4 text-lg text-bark-soft">
            Choisis tes cadeaux préférés sans dépasser tes bons points, puis
            envoie ta liste au Père Noël.
        </p>

        <p v-if="child" class="mt-8 text-lg">
            Il te reste
            <span class="font-display font-bold text-pine">
                {{ child.available_points }} bons points
            </span>
            à dépenser.
        </p>

        <Link
            v-else
            :href="register()"
            class="mt-8 inline-block rounded-cozy bg-berry px-8 py-3 font-display text-lg font-semibold text-cream hover:bg-berry-dark"
        >
            Je m'inscris
        </Link>
    </section>
</template>
