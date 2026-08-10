<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import ChristmasLayout from '@/layouts/ChristmasLayout.vue';
import { index } from '@/routes/gifts';
import type { Gift } from '@/types';

defineOptions({ layout: ChristmasLayout });

defineProps<{ gift: Gift }>();
</script>

<template>
    <Head :title="gift.name" />

    <Link :href="index()" class="text-sm text-bark-soft underline">
        Retour au catalogue
    </Link>

    <div class="mt-6 grid gap-8 md:grid-cols-2">
        <img
            v-if="gift.image"
            :src="gift.image"
            :alt="gift.name"
            class="aspect-4/3 w-full rounded-cozy object-cover shadow-sm"
        />
        <div
            v-else
            class="flex aspect-4/3 w-full items-center justify-center rounded-cozy bg-cream-dark font-display text-xl text-bark-soft"
        >
            {{ gift.name }}
        </div>

        <div class="flex flex-col">
            <p class="text-xs tracking-wide text-bark-soft uppercase">
                {{ gift.category.name }}
            </p>
            <h1 class="mt-1 font-display text-4xl font-bold text-berry">
                {{ gift.name }}
            </h1>
            <p class="mt-4 font-display text-2xl font-bold text-pine">
                {{ gift.points }} bons points
            </p>
        </div>
    </div>
</template>
