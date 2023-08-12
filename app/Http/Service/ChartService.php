<?php

namespace App\Http\Service;

class ChartService
{
    const COLOR_BE = '#ffc107';
    const COLOR_LOSE = '#E46651';
    const COLOR_WIN = '#41B883';
    const COLOR_ALL = '#A1A1A1';

    public function getRadar(array $titles, string $titleFirstData, array $dataFirst, string $titleSecond, array $dataSecond, int $precision = 0): array
    {
        return [
            'data' => [
                'labels' => $titles,
                'datasets' => [
                    [
                        'label' => $titleFirstData,
                        'data' => $dataFirst,
                        'fill' => true,
                        'backgroundColor' => 'rgb(228, 102, 81,0.2)',
                        'borderColor' => self::COLOR_LOSE,
                        'pointBackgroundColor' => self::COLOR_LOSE,
                        'pointBorderColor' => '#fff',
                        'pointHoverBackgroundColor' => '#fff',
                        'pointHoverBorderColor' => self::COLOR_LOSE
                    ],
                    [
                        'label' => $titleSecond,
                        'data' => $dataSecond,
                        'fill' => true,
                        'backgroundColor' => 'rgba(65, 1854, 131, 0.2)',
                        'borderColor' => self::COLOR_WIN,
                        'pointBackgroundColor' => self::COLOR_WIN,
                        'pointBorderColor' => '#fff',
                        'pointHoverBackgroundColor' => '#fff',
                        'pointHoverBorderColor' => 'rgb(65, 1854, 131)'
                    ]
                ],
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
                'scale' => [
                    'ticks' => [
                        'precision' => $precision
                    ]
                ]
            ],
        ];
    }

    public function getDoughnut(array $labels, array $data, array $colors = []): array
    {
        return [
            'data' => [
                'labels' => $labels,
                'datasets' => [
                    [
                        'backgroundColor' => $colors,
                        'data' => $data
                    ],
                ],
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false
            ]
        ];
    }

    public function getLine(array $labels, array $dataSets): array
    {
        return [
            'data' => [
                'labels' => $labels,
                'datasets' => $dataSets
            ],
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false
            ],
        ];
    }

}
