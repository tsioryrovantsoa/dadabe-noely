<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { show } from '@/routes/gifts';
import type { Gift } from '@/types';

defineProps<{ gift: Gift }>();
</script>

<template>
    <Link
        :href="show(gift.id)"
        class="group flex flex-col overflow-hidden rounded-cozy bg-white shadow-sm transition hover:shadow-md"
    >
        <img
            v-if="gift.image"
            :src="gift.image"
            :alt="gift.name"
            class="aspect-4/3 w-full object-cover"
        />
        <div
            v-else
            class="flex aspect-4/3 w-full items-center justify-center bg-cream-dark font-display text-lg text-bark-soft"
        >
            {{ gift.name }}
        </div>

        <div class="flex grow flex-col gap-1 p-4">
            <p class="text-xs tracking-wide text-bark-soft uppercase">
                {{ gift.category.name }}
            </p>
            <h3
                class="font-display text-lg font-semibold group-hover:text-berry"
            >
                {{ gift.name }}
            </h3>
            <p class="mt-auto pt-2 font-display font-bold text-pine">
                {{ gift.points }} points
            </p>
        </div>
    </Link>
</template>
